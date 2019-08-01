
/*let nombreUno:string="juan";   //declaramos las variables con let + nombre + ':tipo de dato'
let nombreDos:string='Jose';
let nombreTres:string=`Bartolo`;

//console.log(nombreUno+", "+nombreDos+", "+nombreTres);
console.log(`${nombreUno}, ${nombreDos}, ${nombreTres}`);
*/
/*
let vec:number[]=[1,4,3,5];
vec.push(3);
vec[0]=2.1646545;

console.log(vec);
*/
//enumeraciones ENUM
/*
enum Talle{
    xs=10,
    s,
    m=10,
    l,
    xl
}


console.log(Talle.xl);
console.log(Talle[12]);*/

//FUNCIONES
function f1(a:string,b:string):string{         //se le indica que retorna :void||:number etc
    return a+b;
}
//let x:string;
//x=f1(3,7);//error al tratar de asignar number a un string
//x=f1(2,3).toString();//todo ok
let x:(a:string,b:string)=>string
x=f1;
