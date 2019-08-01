/// <reference path="./vehiculo.ts" /> 
   ///atajo ref + tab
namespace Clases
{
    export class Auto extends Vehiculo
    {
        constructor(marca:string,ruedas:number)
        {
            super(marca,ruedas);
        }
    }
}