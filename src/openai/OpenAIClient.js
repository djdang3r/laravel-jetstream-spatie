import OpenAI from "openai";

class OpenAIClient {
    constructor() {

    }

    // Método para enviar una solicitud a la API de OpenAI
    async sendMessage(prompt) {
        try {
            const openai = new OpenAI({ apiKey: process.env.OPENAI_API_KEY });
            const completion = await openai.chat.completions.create({
                model: "gpt-4o",
                messages: [
                    {"role": "user", "content": prompt}
                ],
                max_tokens: 326,
                top_p: 0,
                frequency_penalty: 0,
                presence_penalty: 0,
            });

            //return completion.choices[0].text.trim();
            return completion.choices[0].message;
        } catch (error) {
            console.error("Error al conectar con la API de OpenAI:", error.message);
            throw error;
        }
    }
}

export default OpenAIClient;
