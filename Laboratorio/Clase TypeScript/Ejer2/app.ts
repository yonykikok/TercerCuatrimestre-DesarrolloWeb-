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
abstract class Persona{
    protected _nombre:string;
    protected _apellido:string;
    protected _edad:number;

    constructor(nombre:string,apellido:string,edad:number){
        this._nombre=nombre;
        this._apellido=apellido;
        this._edad=edad;
    }
    public set Nombre(nombre : string) {
        this._nombre = nombre;
    }
    public set Apellido(apellido : string) {
        this._apellido = apellido;
    }
    public set Edad(edad : number) {
        this._edad = edad;
    }
    public get Nombre():string{
        return this._nombre
    }
    public get Apellido():string{
        return this._apellido
    }
    public get Edad():number{
        return this._edad
    }
    protected presentarse(){
        console.log(`Hola Soy: ${this.Nombre} ${this.Apellido} ${this.Edad}`);
    }
    
}

//HERENCIA!!

class Empleado extends Persona{

    private _sueldo:number;
    constructor(nombre:string,apellido:string,edad:number,sueldo:number){
        super(nombre,apellido,edad);
        this._sueldo=sueldo;
    }
    
    public set Sueldo(sueldo: number) {
        this._sueldo = sueldo;
    }
    public get Sueldo():number{
        return this._sueldo
    }
    
    public presentarse():void
    {
        super.presentarse();
    }

    public toJSON():string{
        return `{"nombre":${this.Nombre},"apellido":${this.Apellido},"edad":${this.Edad},"sueldo":${this.Sueldo}}`
    }
}




let empleadoUno=new Empleado("Jonathan","Haedo",25,25000);
console.log(empleadoUno.toJSON());