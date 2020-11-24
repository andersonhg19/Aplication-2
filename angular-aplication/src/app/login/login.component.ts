import { Component, OnInit } from '@angular/core';
import { usersmodel } from "../models/users.model";
import { LoginService } from "../services/login/login.service";
import { Routes, Router } from "@angular/router";

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css'],
  providers: [LoginService]
})
export class LoginComponent implements OnInit {

      public usersmodel;      public rows;

  constructor(
    private LoginService: LoginService,
    private router: Router,
  ) { 

    this.usersmodel = new usersmodel();

  }

  ngOnInit() {
    this.validate_session();
  }

  login(){
    console.log(this.usersmodel)
    let params={document:this.usersmodel.num_document,password:this.usersmodel.password}

      this.LoginService.login(params).subscribe(result=>{
        this.rows=result;
        console.log(result);
        if( this.rows){
          console.log('si')
          this.validate_auth(result);
        }else{
          console.log('no')
        
        }
    
      
    },error=>{
      console.log(error);
    })   
  }

  validate_auth(loginmodel) {
    console.log(loginmodel)
      let _user = JSON.stringify(loginmodel.result);
      localStorage.setItem("token", _user);
      this.validate_session();
  }

  validate_session() {
    let _user = localStorage.getItem("token");
    if (_user) this.router.navigate(["/home"]);
    else this.router.navigate(["/"]);
  }


}
