import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpErrorResponse } from '@angular/common/http';
import { Observable } from 'rxjs/observable';
import "rxjs/add/operator/map";
import { constantes } from "../../utilitis/constantes";


@Injectable()
export class RegisterUserService {     
    private constantes;
    private url;
  
    constructor(private http: HttpClient) {
      this.constantes = new constantes();
    }
    
    create(params) {
        this.url = this.constantes.routeGlobal + "api/register";
        console.log(params);
        return this.http.post(this.url, params).map(res => console.log(res));
      }

      typeDocuments(params) {
        this.url = this.constantes.routeGlobal + "api/type_documents";
        return this.http.get(this.url, params).map(res => res);
      }
      typeUser(params) {
        this.url = this.constantes.routeGlobal + "api/type_user";
        return this.http.get(this.url, params).map(res => res);
      }
      typeCommunication(params) {
        this.url = this.constantes.routeGlobal + "api/type_communications";
        return this.http.get(this.url, params).map(res => res);
      }
      stateUsers(params) {
        this.url = this.constantes.routeGlobal + "api/state_user";
        return this.http.get(this.url, params).map(res => res);
      }
      services(params) {
        this.url = this.constantes.routeGlobal + "api/services";
        return this.http.get(this.url, params).map(res => res);
      }
}