import { createApp } from 'vue';
import '../css/app.css';

import ExampleComponent from './components/ExampleComponent.vue';

// Verifica se existe um elemento com id="app"
const el = document.getElementById('app');

if (el) {
    const app = createApp({});
    app.component('example-component', ExampleComponent);
    console.log('Vue App está a correr...');
    app.mount('#app');
} else {
    console.log('Vue App não foi montado: #app não encontrado na view.');
}
