import WooCommerceRestApi from '@woocommerce/woocommerce-rest-api';

// Accede al constructor desde la propiedad default
const WooCommerce = new WooCommerceRestApi.default({
    /*
    url: 'http://wooprueba.test', // URL de tu tienda WooCommerce
    consumerKey: 'ck_30fb28b7c47b084a0f02ae4b69c41bb6ca56d90a', // Reemplaza con tu Consumer Key
    consumerSecret: 'cs_c782cd2ef8c6de889f46f61cc3d0f50bf090bc91', // Reemplaza con tu Consumer Secret
    version: 'wc/v3' // Versión de la API de WooCommerce
    */

    url: 'https://cornerparts.cl', // URL de tu tienda WooCommerce
    consumerKey: 'ck_805882d71fce7a9ceaea727141a44f741506ecbe', // Reemplaza con tu Consumer Key
    consumerSecret: 'cs_0f9e37229181c7fd4704586d8c3122404cae8a9d', // Reemplaza con tu Consumer Secret
    version: 'wc/v3' // Versión de la API de WooCommerce
});

class WoocommerceFunctions {
    constructor() {

    }

    async getProducts() {
        try {
            const response = await this.api.get("products/");
            console.log("Productos obtenidos:", response.data);
            return response.data;
        } catch (error) {
            console.error("Error al obtener los productos:", error.response ? error.response.data : error.message);
        }
    }

    /*
        WooCommerce.get("products/categories")
        .then((response) => {
            //console.log(response.data);
            const filteredCategories = response.data.filter(category => category.count > 0);
        
            console.log("Categorías de productos con count > 0:", filteredCategories);
            return response.data;
        })
        .catch((error) => {
            console.log(error.response.data);
        });
        */

    async getCategories() {
        try {
            const response = await WooCommerce.get("products/categories");
            const filteredCategories = response.data.filter(category => category.count > 0);
            //console.dir(response.data, { depth: null, colors: true });
            // Convierte las categorías filtradas a texto
            const categoriesText = filteredCategories.map(category => {
                // Extrae el enlace self si está disponible
                //const selfLink = category._links?.collection?.[0]?.href || 'No disponible';
                const selfLink = 'No disponible';
                return `- ${category.name} (${category.count} productos) - Link: ${selfLink} - ID: ${category.id}`;
            }).join('\n');

            // Imprime el texto de categorías
            //console.log("Categorías de productos con count > 0:");
            console.log(categoriesText);

            return categoriesText;
        } catch (error) {
            console.error("Error al obtener las categorías:", error.response ? error.response.data : error.message);
            return "No se pudieron obtener las categorías.";
        }
    }

    async searchProducts(query) {
        console.log('Query: ' + query);

        const text = query; 

        let queryParams = {};

        try {
            const containsCategory = text.includes('category');
            const containsInclude = text.includes('include');
    
            // Extraer el valor de la consulta
            if (containsCategory) {
                // Extraer el valor de la categoría usando expresión regular
                const categoryMatch = text.match(/category\s*:\s*'(\d+)'/);
                if (categoryMatch) {
                    queryParams.category = categoryMatch[1];
                } else {
                    throw new Error("No se encontró un ID de categoría válido.");
                }
            }
    
            if (containsInclude) {
                // Extraer el valor de los IDs de productos usando expresión regular
                const includeMatch = text.match(/include\s*:\s*'([\d,]+)'/);
                if (includeMatch) {
                    queryParams.include = includeMatch[1];
                } else {
                    throw new Error("No se encontraron IDs de productos válidos.");
                }
            }
    
            // Verifica si se construyó algún parámetro de consulta
            if (Object.keys(queryParams).length > 0) {
                const response = await WooCommerce.get('products', queryParams);
                return response.data;
            } else {
                throw new Error("No se proporcionó una consulta válida.");
            }
            
        } catch (error) {
            console.error("Error al buscar productos:", error.response ? error.response.data : error.message);
            return [];
        }
    }

    async parseResponse(text) {
        try {
            // Asegúrate de que el texto sea una cadena JSON válida
            const cleanedText = text
                .replace(/^\s*'|'\s*$/g, '') // Elimina comillas simples al principio y al final
                .replace(/\s+/g, ''); // Elimina espacios adicionales
    
            const jsonObject = JSON.parse(cleanedText);
            return jsonObject;
        } catch (e) {
            console.error('Error parsing response:', e);
            return null; // O maneja el error de otra forma
        }
    }

}

export default WoocommerceFunctions;