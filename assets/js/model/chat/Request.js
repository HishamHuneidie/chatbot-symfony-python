class Request {
    #message;
    #key;

    constructor(message, key) {
        this.#message = message;
        this.#key = key;
    }

    getMessage() {
        return this.#message;
    }

    getKey() {
        return this.#key;
    }

    toString() {

        return JSON.stringify({
            "message": this.getMessage(),
            "key": this.getKey(),
        });
    }

    toObject() {

        return {
            "message": this.getMessage(),
            "key": this.getKey(),
        };
    }
}

module.exports = Request;