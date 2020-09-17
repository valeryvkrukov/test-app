import Vue from 'vue';
import App from '@/App';
import router from '@/router/router';

import 'styles/app.scss';

new Vue({
    router,
    render: h => h(App),
}).$mount('#test-app');