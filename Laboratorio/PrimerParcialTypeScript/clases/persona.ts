abstract class Persona{
 protected _id:number;
 protected _nombre:string;
 protected _apellido:string;
 protected _email:string;
 protected _gender:Enumerator; 
 protected _active:boolean;


 constructor (nombre:string,apellido:string,email:string,gender:Enumerator,active:boolean){
     this._active=active;
     this._nombre=nombre;
     this._apellido=apellido;
     this._email=email;
     this._gender=gender;
 }
 
 public set Nombre(nombre : string) {
     this._nombre = nombre;
 } 
 
 public set Apellido(apellido : string) {
     this._apellido = apellido;
 }
 
 public set Email(email : string) {
     this._email = email;
 } 
 
 public set Gender(gender : Enumerator) {
     this._gender = gender;
 }
 
 public set Active(active : boolean) {
     this._active = active;
 }
 
 public get Nombre() : string {
     return this._nombre;
 }
 
 public get Apellido() : string {
     return this._apellido;
 }
 
 public get Email() : string {
     return this._email;
 }
 
 public get Gender() : Enumerator {
     return this._gender;
 }
 
 public get Active() : boolean {
     return this._active;
 }
 
 
}