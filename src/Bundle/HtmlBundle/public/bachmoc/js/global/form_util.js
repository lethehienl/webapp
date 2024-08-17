global.FormUtil = {
    serializeObject: function(formElement) {
        var o = {};
        var a = $(formElement).serializeArray();
        $.each(a, function() {
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    },

    validaNumberInput: function() {
        //TODO class: number-only
    }
};
