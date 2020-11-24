import { Component, OnInit } from '@angular/core';
import { pqrsmodel } from '..//../models/pqrs.model';
import { PqrsService } from "../../services/pqrs/pqrs.service";
import swal from'sweetalert2';


@Component({
  selector: 'app-pqrs',
  templateUrl: './pqrs.component.html',
  styleUrls: ['./pqrs.component.css']
})
export class PqrsComponent implements OnInit {
  public pqrsmodel;

  constructor(
    private PqrsService:PqrsService,
  ) { 
    this.pqrsmodel=new pqrsmodel();
  }

  ngOnInit(): void {
  }


  submit(){
    console.log(this.pqrsmodel)
    let params = {pqrs:this.pqrsmodel};
    console.log(params)
    this.PqrsService.create(params).subscribe(result=>{
    },error=>{
      swal.fire( 'Ha ocurrido un error','Los datos no son correctos','error');
  })   
  }


}
