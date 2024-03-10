Object.defineProperty(Element.prototype, 'getParentByClass', {
    enumerable: false,
    value: function (className) {
        let parent = this.parentNode;
        while (!parent.classList.contains(className) && parent.localName !== 'body') {
            parent = parent.parentNode;
        }

        if (!parent.classList.contains(className)) {
            return null;
        }

        return parent;
    },
});

Object.defineProperty(String.prototype, 'toObject', {
    enumerable: false,
    value: function () {
        try {
            return JSON.parse(this);
        } catch (e) {
            return null;
        }
    },
});

function getClass(item) {
    return item.constructor.name;
}