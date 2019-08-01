var Persona = /** @class */ (function () {
    function Persona(nombre, apellido, email, gender, active) {
        this._active = active;
        this._nombre = nombre;
        this._apellido = apellido;
        this._email = email;
        this._gender = gender;
    }
    Object.defineProperty(Persona.prototype, "Nombre", {
        get: function () {
            return this._nombre;
        },
        set: function (nombre) {
            this._nombre = nombre;
        },
        enumerable: true,
        configurable: true
    });
    Object.defineProperty(Persona.prototype, "Apellido", {
        get: function () {
            return this._apellido;
        },
        set: function (apellido) {
            this._apellido = apellido;
        },
        enumerable: true,
        configurable: true
    });
    Object.defineProperty(Persona.prototype, "Email", {
        get: function () {
            return this._email;
        },
        set: function (email) {
            this._email = email;
        },
        enumerable: true,
        configurable: true
    });
    Object.defineProperty(Persona.prototype, "Gender", {
        get: function () {
            return this._gender;
        },
        set: function (gender) {
            this._gender = gender;
        },
        enumerable: true,
        configurable: true
    });
    Object.defineProperty(Persona.prototype, "Active", {
        get: function () {
            return this._active;
        },
        set: function (active) {
            this._active = active;
        },
        enumerable: true,
        configurable: true
    });
    return Persona;
}());
