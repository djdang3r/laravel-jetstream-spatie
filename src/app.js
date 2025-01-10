import { join } from 'path'
import { createBot, createProvider, createFlow, addKeyword, utils, EVENTS } from '@builderbot/bot'
import { MysqlAdapter as Database } from '@builderbot/database-mysql'
import { MetaProvider as Provider } from '@builderbot/provider-meta'
import MainFlow from './flows/mainFlow.js'
import FlowHablar from './flows/flowHablar.js'
import CatalogoFlow from './flows/flowCatalogo.js'
import FiltrarProductoFlow from './flows/flowFiltroProductos.js'
import morgan from 'morgan'

const principalFlow = addKeyword('')
    .addAction(
        async (ctx, { flowDynamic, state, fallBack, gotoFlow }) => {
            console.log('Checking fo phoneNumber: ', ctx.from)
            const opcion = await MainFlow(ctx, { flowDynamic, state, fallBack, gotoFlow })
            console.log(opcion)
            if (opcion === 'HABLAR') {
                return gotoFlow(hablarFlow)
            }
            if (opcion === 'CATALOGO') {
                return gotoFlow(catalogoFlow)
            }
            if (opcion === 'SALUDAR') {
                await flowDynamic('Bienvenido a CornerpartsCl, en que podemos ayudarte?')
            }
            if (opcion === 'FILTRAR_PRODUCTOS') {
                return gotoFlow(filtrarProductoFlow) // Dirigir al flujo de filtrado
            }
        }
    )

const hablarFlow = addKeyword(EVENTS.ACTION)
    .addAction(
        async (ctx, { flowDynamic, state, fallBack, gotoFlow }) => {
            const respuesta = await FlowHablar(ctx, { flowDynamic, state, fallBack, gotoFlow })
            await flowDynamic(respuesta)
        }
    )

const catalogoFlow = addKeyword(EVENTS.ACTION)
    .addAction(
        async (ctx, { flowDynamic, state, fallBack, gotoFlow }) => {
            const respuesta = await CatalogoFlow(ctx, { flowDynamic, state, fallBack, gotoFlow })
            await flowDynamic(respuesta)
            await flowDynamic('Estamos a tu disposicion')
        }
    )

const filtrarProductoFlow = addKeyword(EVENTS.ACTION)
    .addAction(
        async (ctx, { flowDynamic, state, fallBack, gotoFlow }) => {
            console.log('Lista de productos filtro')
            const respuesta = await FiltrarProductoFlow(ctx, { flowDynamic, state, fallBack, gotoFlow })
            await flowDynamic(respuesta)
        }
    )

const dxFlow = addKeyword('hola').addAnswer(
    ['Probando con diferentes palabras', '📄 https://builderbot.app/docs \n', 'Do you want to continue? *yes*'].join(
        '\n'
    ),
    { capture: true },
    async (ctx, { gotoFlow, flowDynamic }) => {
        if (ctx.body.toLocaleLowerCase().includes('yes')) {
            return gotoFlow(registerFlow)
        }
        await flowDynamic('Thanks!')
        return
    }
)

const discordFlow = addKeyword('doc').addAnswer(
    ['You can see the documentation here', '📄 https://builderbot.app/docs \n', 'Do you want to continue? *yes*'].join(
        '\n'
    ),
    { capture: true },
    async (ctx, { gotoFlow, flowDynamic }) => {
        if (ctx.body.toLocaleLowerCase().includes('yes')) {
            return gotoFlow(registerFlow)
        }
        await flowDynamic('Thanks!')
        return
    }
)

const welcomeFlow = addKeyword(['hi', 'hello', 'hola'])
    .addAnswer(`🙌 Hello welcome to this *Chatbot*`)
    .addAnswer(
        [
            'I share with you the following links of interest about the project',
            '👉 *doc* to view the documentation',
        ].join('\n'),
        { delay: 800, capture: true },
        async (ctx, { fallBack }) => {
            if (!ctx.body.toLocaleLowerCase().includes('doc')) {
                return fallBack('You should type *doc*')
            }
            return
        },
        [discordFlow]
    )

const registerFlow = addKeyword(utils.setEvent('REGISTER_FLOW'))
    .addAnswer(`What is your name?`, { capture: true }, async (ctx, { state }) => {
        await state.update({ name: ctx.body })
    })
    .addAnswer('What is your age?', { capture: true }, async (ctx, { state }) => {
        await state.update({ age: ctx.body })
    })
    .addAction(async (_, { flowDynamic, state }) => {
        await flowDynamic(`${state.get('name')}, thanks for your information!: Your age: ${state.get('age')}`)
    })

const fullSamplesFlow = addKeyword(['samples', utils.setEvent('SAMPLES')])
    .addAnswer(`💪 I'll send you a lot files...`)
    .addAnswer(`Send image from Local`, { media: join(process.cwd(), 'assets', 'sample.png') })
    .addAnswer(`Send video from URL`, {
        media: 'https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExYTJ0ZGdjd2syeXAwMjQ4aWdkcW04OWlqcXI3Ynh1ODkwZ25zZWZ1dCZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/LCohAb657pSdHv0Q5h/giphy.mp4',
    })
    .addAnswer(`Send audio from URL`, { media: 'https://cdn.freesound.org/previews/728/728142_11861866-lq.mp3' })
    .addAnswer(`Send file from URL`, {
        media: 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
    })

const createBotInstance = async (botConfig) => {
    const adapterFlow = createFlow(botConfig.flows)

    const adapterProvider = createProvider(Provider, {
        jwtToken: botConfig.jwtToken,
        numberId: botConfig.numberId,
        verifyToken: botConfig.verifyToken,
        version: botConfig.version,
    })

    const adapterDB = new Database({
        host: botConfig.dbHost,
        user: botConfig.dbUser,
        database: botConfig.dbName,
        password: botConfig.dbPassword,
    })

    const { handleCtx, httpServer } = await createBot({
        flow: adapterFlow,
        provider: adapterProvider,
        database: adapterDB,
    })

    adapterProvider.server.use(morgan('dev'))

    adapterProvider.server.post(
        '/v1/messages',
        handleCtx(async (bot, req, res) => {
            const { number, message, urlMedia } = req.body
            await bot.sendMessage(number, message, { media: urlMedia ?? null })
            return res.end('sended')
        })
    )

    adapterProvider.server.post(
        '/v1/register',
        handleCtx(async (bot, req, res) => {
            const { number, name } = req.body
            await bot.dispatch('REGISTER_FLOW', { from: number, name })
            return res.end('trigger')
        })
    )

    adapterProvider.server.post(
        '/v1/samples',
        handleCtx(async (bot, req, res) => {
            const { number, name } = req.body
            await bot.dispatch('SAMPLES', { from: number, name })
            return res.end('trigger')
        })
    )

    adapterProvider.server.post(
        '/v1/blacklist',
        handleCtx(async (bot, req, res) => {
            const { number, intent } = req.body
            if (intent === 'remove') bot.blacklist.remove(number)
            if (intent === 'add') bot.blacklist.add(number)

            res.writeHead(200, { 'Content-Type': 'application/json' })
            return res.end(JSON.stringify({ status: 'ok', number, intent }))
        })
    )

    // Añadir la ruta /webhook
    adapterProvider.server.post(
        '/webhook',
        handleCtx(async (bot, req, res) => {
            const data = req.body
            // Aquí puedes manejar la lógica para el webhook
            console.log('Webhook received:', data)
            return res.end('Webhook received')
        })
    )

    httpServer(botConfig.port)
}

const main = async () => {
    const botsConfig = [
        {
            flows: [dxFlow, welcomeFlow, registerFlow, fullSamplesFlow],
            jwtToken: '',
            numberId: '194112953793281',
            verifyToken: 'QWERTY3135694227',
            version: 'v21.0',
            dbHost: 'localhost',
            dbUser: 'root',
            dbName: 'basic-proyect',
            dbPassword: '',
            port: 3008,
        },
        {
            flows: [dxFlow, welcomeFlow, registerFlow, fullSamplesFlow],
            jwtToken: '',
            numberId: '444327995434415',
            verifyToken: 'QWERTY3135694227',
            version: 'v21.0',
            dbHost: 'localhost',
            dbUser: 'root',
            dbName: 'basic-proyect',
            dbPassword: '',
            port: 3009,
        },
    ]

    for (const botConfig of botsConfig) {
        await createBotInstance(botConfig)
    }
}

main().catch(console.error)
