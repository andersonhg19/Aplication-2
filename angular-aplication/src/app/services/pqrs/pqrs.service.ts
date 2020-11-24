import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpErrorResponse } from '@angular/common/http';
import { Observable } from 'rxjs/observable';
import "rxjs/add/operator/map";
import { constantes } from "../../utilitis/constantes";


@Injectable()
export class PqrsService {     
    private constantes;
    private url;
  
    constructor(private http: HttpClient) {
      this.constantes = new constantes();
    }
    
    create(params) {
        this.url = this.constantes.routeGlobal + "api/pqrs";
        console.log(params);
        return this.http.post(this.url, params).map(res => console.log(res));
      }

}