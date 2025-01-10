import { join } from 'path'
import { createBot, createProvider, createFlow, addKeyword, utils } from '@builderbot/bot'
import OpenAIClient from '../openai/OpenAIClient.js';
import History from '../models/HistoryModel/HistoryModel.js'

const openAipromt = new OpenAIClient();
const historial = new History();

export default async (ctx, { flowDynamic, state, fallBack, gotoFlow }) => {

    const conversationHistory = await historial.getConversationHistory(ctx.from);

    if (conversationHistory === undefined) {
        console.error('Error: No se pudo obtener el historial de la conversación.');
        conversationHistory = 'No existe conversacion';
    }


    const formattedHistory = await historial.formatHistory(conversationHistory);

    if (formattedHistory === undefined) {
        console.error('Error: El historial formateado es undefined.');
        formattedHistory = 'No hay conversacion abierta'
    }

    //console.log('Tipos '+formattedHistory);


    const prompt = `Como una inteligencia artificial avanzada, tu tarea es analizar el contexto de una conversación y determinar cuál de las siguientes acciones es más apropiada para realizar:
    --------------------------------------------------------
    Historial de conversación:
    {HISTORY}
    
    Posibles acciones a realizar:
    1. HABLAR: Se debe seleccionar esta opción cuando el cliente hace preguntas generales o pide información que no está relacionada con productos específicos. También se selecciona si no hay una conversación previa y el cliente busca iniciar una interacción para obtener detalles generales sobre la empresa.
    2. CATALOGO: Esta opción se activa cuando el cliente pide ver un catálogo de productos o información general sobre las categorías de productos disponibles. El cliente no está buscando un producto específico, sino una lista de opciones para explorar.
    3. SALUDAR: Esta opción es para cuando es la primera vez que el cliente se comunica o no ha tenido conversaciones anteriores. Se usa para darle la bienvenida y ofrecer asistencia inicial.
    4. FILTRAR_PRODUCTOS: Esta opción se selecciona cuando el cliente ya ha mencionado un tipo de producto específico o una categoría dentro del catálogo, y desea ver una lista detallada de productos filtrados según sus preferencias.
    -----------------------------
    Tu objetivo es comprender la intención del cliente y seleccionar la acción más adecuada en respuesta a su declaración.
    
    Respuesta ideal (AGENDAR|HABLAR|CONFIRMAR):`.replace('{HISTORY}', formattedHistory)


    const text = await openAipromt.sendMessage(prompt);

    //console.log(text);

    if (text.content.includes('SALUDAR')) return 'SALUDAR';
    if (text.content.includes('HABLAR')) return 'HABLAR';
    if (text.content.includes('CATALOGO')) return 'CATALOGO';
    if (text.content.includes('FILTRAR_PRODUCTOS')) return 'FILTRAR_PRODUCTOS';
}