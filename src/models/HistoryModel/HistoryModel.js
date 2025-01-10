import chalk from 'chalk';

import mysql from 'mysql2/promise';

class History {
    constructor() {
        // Configuración de conexión
        this.connection = mysql.createPool({
            host: 'localhost',     // Cambia por tu host
            user: 'root',           // Tu usuario de MySQL
            password: '',   // Tu contraseña
            database: 'cornerparts' // Tu base de datos
        });
    }

    async getConversationHistory(phone) {
        const query = `
            SELECT 
                id, answer, created_at
            FROM history
            WHERE phone = ?
            AND DATE(created_at) = CURDATE()
            AND answer != '__call_action__';
        `;
        try {
            const [rows] = await this.connection.execute(query, [phone]);
            return rows;
        } catch (error) {
            console.error('Error al obtener el historial de la conversación:', error);
            throw error;
        }
    }

    async formatHistory(historyArray) {
        return historyArray.map(item => {
            // Formatear la fecha
            const date = new Date(item.created_at);
            const formattedDate = date.toLocaleDateString();
            const formattedTime = date.toLocaleTimeString();
            
            // Crear el texto legible
            return `Mensaje ID: ${item.id}\nFecha: ${formattedDate} ${formattedTime}\nMensaje: ${item.answer}\n`;
        }).join("\n--------------------\n");
    }
}

export default History;


