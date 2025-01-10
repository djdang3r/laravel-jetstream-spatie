import OpenAIClient from '../openai/OpenAIClient.js';
import WoocommerceFunctions from '../woocommerce/WoocommerceFunctions.js';
import History from '../models/HistoryModel/HistoryModel.js';

const openAipromt = new OpenAIClient();
const wc = new WoocommerceFunctions();
const historial = new History();

export default async (ctx, { flowDynamic, state, fallBack, gotoFlow }) => {
    // Obtener el historial de conversación y formatearlo
    const conversationHistory = await historial.getConversationHistory(ctx.from);
    const formattedHistory = await historial.formatHistory(conversationHistory);
    const categorias = await wc.getCategories();

    const prompt = `Eres el asistente virtual en la prestigiosa tienda en linea "Corner Parts Cl", tu labor es tomar el historial de conversacion y segun lo que desea buscar el usuario para recibir del producto o el listado de productos que desea. Determinar si el cliente se refiere a una categoria del catalogo a algun producto o productos especificos y determinar el ID del producto o los productos segun la conversacion o el ID de la categoria que desea.
    Deberas generar el query para la consulta del filtro segun lo siquiete:

    Para buscar por el Id de la categoria, la palabra category sin comillas simples o dobles y debe ser un objeto json:
    {
        category: 'ID_DE_LA_CATEGORÍA'
    }

    Para uno o mas productos segun su ID especifico de debe usar el siguiente ejemplo para uno o mas ID.
    {
        include: 'ID1,ID2,ID3' // Lista de IDs de productos separados por coma
    }

    retorna solo el query.

    Historial
    -------------
    '{HISTORY}'
    -------------

    la siguiente es una lista de categorias que debes usar para tener en cuenta el ID de la categoria y poder redirigir al cliente la informacion que requiere y formar el query para la consulta de la mejor naera.
    Categorias
    -------------
    {CATEGORIES}
    -------------

    
    `.replace('{HISTORY}', formattedHistory).replace('{CATEGORIES}', categorias);



    const text = await openAipromt.sendMessage(prompt);



    // El cliente envía un mensaje con los productos que desea buscar
    //const clientQuery = ctx.body.toLowerCase();  // Tomar el texto del cliente

    //console.log('text content ', text);
    let clientQuery = text.content;
    clientQuery = clientQuery.replace(/^```json\n|\n```$/g, '').trim();
    // const test = JSON.parse( JSON.stringify(clientQuery));
    // const objectkeys = Object.keys( clientQuery )
    // console.log(test);
    console.log('Query '+clientQuery);
    //console.log(JSON.parse( clientQuery ));
    
    // Filtrar productos en WooCommerce usando la consulta del cliente
    const productos = await wc.searchProducts( clientQuery );  // Implementar el método searchProducts en WoocommerceFunctions

    // Si se encuentran productos, mostrar la lista filtrada
    if (productos.length > 0) {
        const productosText = productos.map(producto => 
            `- ${producto.name} ($${producto.price}) - ID: ${producto.id} - Ver más: ${producto.permalink}`
        ).join('\n\n');
        
        await flowDynamic([
            { body: `Aquí tienes los productos que coinciden con tu búsqueda:\n${productosText}` }
        ]);
    } else {
        // Si no se encuentran productos, informar al cliente
        await flowDynamic([
            { body: `Lo siento, no encontré productos que coincidan con tu búsqueda: "${clientQuery}".` }
        ]);
    }
};