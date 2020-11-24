import { Component, OnInit } from '@angular/core';
import { usersmodel } from '../../models/users.model';
import { RegisterUserService } from '../../services/register-users/register-user.service';
import swal from'sweetalert2';

@Component({
  selector: 'app-register-user',
  templateUrl: './register-user.component.html',
  styleUrls: ['./register-user.component.css']
})
export class RegisterUserComponent implements OnInit {
  public usersmodel;
  public rows;
  public rowss;
  public rows2;
  public rowss2;
  public rows3;
  public rowss3;
  public rows4;
  public rowss4;
  public rows5;
  public rowss5;


  constructor(
    private RegisterUserService:RegisterUserService,
  ) {this.usersmodel = new usersmodel() }

  ngOnInit(): void {
    this.typeDocuments();
    this.typeUser();
    this.typeCommunication();
    this.stateUsers();
    this.services();
  }

  submit(){
    
    console.log(this.usersmodel)
   
    let params = {user:this.usersmodel};
    console.log(params)
    this.RegisterUserService.create(params).subscribe(result=>{
     
    },error=>{
      swal.fire( 'Ha ocurrido un error','Los datos no son correctos','error');
  })   
  }

  typeDocuments(){
   let params;
    this.RegisterUserService.typeDocuments(params).subscribe(result=>{
      this.rowss=result;
      this.rows=this.rowss.search;
      console.log(this.rows);
    },error=>{})
  }
  typeUser(){
    let params;
     this.RegisterUserService.typeUser(params).subscribe(result=>{
       this.rowss2=result;
       this.rows2=this.rowss2.search;
       console.log(this.rows2);
     },error=>{})
   }
   typeCommunication(){
    let params;
     this.RegisterUserService.typeCommunication(params).subscribe(result=>{
       this.rowss3=result;
       this.rows3=this.rowss3.search;
       console.log(this.rows3);
     },error=>{})
   }
   stateUsers(){
    let params;
     this.RegisterUserService.stateUsers(params).subscribe(result=>{
       this.rowss4=result;
       this.rows4=this.rowss4.search;
       console.log(this.rows4);
     },error=>{})
   }
   services(){
    let params;
     this.RegisterUserService.services(params).subscribe(result=>{
       this.rowss5=result;
       this.rows5=this.rowss5.search;
       console.log(this.rows5);
     },error=>{})
   }


}
