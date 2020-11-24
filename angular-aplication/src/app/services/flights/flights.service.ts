import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpErrorResponse } from '@angular/common/http';
import { Observable } from 'rxjs/observable';
import "rxjs/add/operator/map";
import { constantes } from "../../utilitis/constantes";


@Injectable()
export class FlightsService {     
    private constantes;
    private url;
  
    constructor(private http: HttpClient) {
      this.constantes = new constantes();
    }
    

 
    create(params) {
        this.url = this.constantes.routeGlobal + "api1/create_flights";
        return this.http.post(this.url, params).map(res => console.log(res));
      }

      plane(params) {
        this.url = this.constantes.routeGlobal + "api/plane";
        return this.http.get(this.url, params).map(res => res);
      }
      searchRoutes(params) {
        console.log(params)
        this.url = this.constantes.routeGlobal + "api/routes";
        return this.http.get(this.url, params).map(res => res);
      }
}