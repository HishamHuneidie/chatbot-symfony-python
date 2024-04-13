class Response {
    #answer;

    constructor(answer) {
        this.#answer = answer;
    }

    getAnswer() {
        return this.#answer;
    }

    static fromString(jsonString) {

        try {
            let json = JSON.parse(jsonString);
            return new this(json.answer);
        } catch (e) {
            console.error(e.message);
            return null;
        }
    }
}

module.exports = Response;