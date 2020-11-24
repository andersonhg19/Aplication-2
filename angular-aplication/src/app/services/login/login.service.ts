import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpErrorResponse } from '@angular/common/http';
import { Observable } from 'rxjs/observable';
import "rxjs/add/operator/map";
import { constantes } from "../../utilitis/constantes";


@Injectable()
export class LoginService {     
    private constantes;
    private url;
  
    constructor(private http: HttpClient) {
      this.constantes = new constantes();
    }


  login(params) {
    this.url = this.constantes.routeGlobal + "api/login";
    return this.http.post(this.url, params).pipe(result=>result);
  }


}