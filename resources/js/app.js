import { createApp } from 'vue';
import '../css/app.css';

import ExampleComponent from './components/ExampleComponent.vue';

const app = createApp({});

// Aqui registramos um componente (opcional)
app.component('example-component', ExampleComponent);

console.log('Vue App está a correr...');

app.mount('#app'); // montamos no ID onde quiseres

