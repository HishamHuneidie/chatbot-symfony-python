class ChatbotApp {
    static #instance;

    ajax(url, method, params = {}, successCallback, errorCallback) {

        let xhr = new XMLHttpRequest();
        let form = this.#buildForm(params);

        xhr.addEventListener('load', e => {
            console.warn(xhr.status);
            if (xhr.status >= 200 && xhr.status < 300) {
                if (getClass(successCallback) === 'Function') {
                    successCallback(xhr.responseText);
                }
                return;
            }
            if (getClass(errorCallback) === 'Function') {
                errorCallback(xhr.responseText);
            }
        });
        xhr.open(method, url);
        xhr.send(form);
    }

    #buildForm(params) {
        let form = new FormData();

        Object
            .entries(params)
            .forEach(([key, value], i) => {
                form.append(key, value);
            });

        return form;
    }

    static getInstance() {
        if (!this.#instance) {
            this.#instance = new this();
        }

        return this.#instance;
    }
}

module.exports = ChatbotApp;