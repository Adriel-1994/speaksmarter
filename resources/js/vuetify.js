import 'vuetify/styles'
import '@mdi/font/css/materialdesignicons.css'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import { es } from 'vuetify/locale'
const vuetify = createVuetify({
    components,
    directives,
    locale: {
        locale: 'es',
        fallback: 'es',
        messages: { es },
    },
})

export default vuetify;
