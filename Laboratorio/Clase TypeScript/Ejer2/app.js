"use strict";
//creamos un objeto y especificamos los campos
/*let Persona:{getNombre:()=>string,sabeNadar:boolean,edad:number,nombre:string,apellido:string}={
    nombre:"juan",
    apellido:"Perez",
    edad:23,
    sabeNadar:true,
    getNombre:function():string{
        return this.nombre;
    }
};
console.log(Persona.getNombre());
*/
//creamos un tipo de dato/*
var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
/*type Persona={getNombre:()=>string,sabeNadar:boolean,edad:number,nombre:string,apellido:string};
let personaUno:Persona={
    nombre:"juan",
    apellido:"Perez",
    edad:23,
    sabeNadar:true,
    getNombre:function():string{
        return this.nombre;
    }
};*/
/*
type Persona={getNombre:()=>string,setAtribute:(dato:any,propiedad:string)=>void,sabeNadar:boolean,edad:number,nombre:string,apellido:string};
let personaUno:Persona={
    nombre:"juan",
    apellido:"Perez",
    edad:23,
    sabeNadar:true,
    getNombre:function():string{
        return this.nombre;
    },
    setAtribute:function(dato,propiedad):void{
        switch(propiedad)
        {
            case "nombre":
                this.nombre=dato;
                    break;
            case "apellido":
                    this.apellido=dato;
                    break;
            case "edad":
                    this.edad=dato;
                    break;
            case "sabeNadar":
                    this.sabeNadar=dato;
                    break;
        }
    }
};
let personaDos:Persona={
    nombre:"matias",
    apellido:"murray",
    edad:23,
    sabeNadar:true,
    getNombre:function():string{
        return this.nombre;
    },
    setAtribute:function(dato,propiedad):void{
        switch(propiedad)
        {
            case "nombre":
                this.nombre=dato;
                    break;
            case "apellido":
                    this.apellido=dato;
                    break;
            case "edad":
                    this.edad=dato;
                    break;
            case "sabeNadar":
                    this.sabeNadar=dato;
                    break;
        }
    }
};
console.log(personaUno.nombre+" "+personaUno.apellido+" "+personaUno.edad +" "+personaUno.sabeNadar);
personaUno.setAtribute("jonathan","nombre");
personaUno.setAtribute("haedo","apellido");
personaUno.setAtribute("25","edad");
personaUno.setAtribute("sabeNadar","true");
console.log(personaUno.nombre+" "+personaUno.apellido+" "+personaUno.edad +" "+personaUno.sabeNadar);*/
//CLASSES 
var Persona = /** @class */ (function () {
    function Persona(nombre, apellido, edad) {
        this._nombre = nombre;
        this._apellido = apellido;
        this._edad = edad;
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
    Object.defineProperty(Persona.prototype, "Edad", {
        get: function () {
            return this._edad;
        },
        set: function (edad) {
            this._edad = edad;
        },
        enumerable: true,
        configurable: true
    });
    Persona.prototype.presentarse = function () {
        console.log("Hola Soy: " + this.Nombre + " " + this.Apellido + " " + this.Edad);
    };
    return Persona;
}());
//HERENCIA!!
var Empleado = /** @class */ (function (_super) {
    __extends(Empleado, _super);
    function Empleado(nombre, apellido, edad, sueldo) {
        var _this = _super.call(this, nombre, apellido, edad) || this;
        _this._sueldo = sueldo;
        return _this;
    }
    Object.defineProperty(Empleado.prototype, "Sueldo", {
        get: function () {
            return this._sueldo;
        },
        set: function (sueldo) {
            this._sueldo = sueldo;
        },
        enumerable: true,
        configurable: true
    });
    Empleado.prototype.presentarse = function () {
        _super.prototype.presentarse.call(this);
    };
    Empleado.prototype.toJSON = function () {
        return "{\"nombre\":" + this.Nombre + ",\"apellido\":" + this.Apellido + ",\"edad\":" + this.Edad + ",\"sueldo\":" + this.Sueldo + "}";
    };
    return Empleado;
}(Persona));
var empleadoUno = new Empleado("Jonathan", "Haedo", 25, 25000);
console.log(empleadoUno.toJSON());
