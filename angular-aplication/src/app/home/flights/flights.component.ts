import { Component, OnInit } from '@angular/core';
import { flightsmodel } from '../../models/flights.model';
import { FlightsService } from '../../services/flights/flights.service';
import swal from'sweetalert2';

@Component({
  selector: 'app-flights',
  templateUrl: './flights.component.html',
  styleUrls: ['./flights.component.css']
})
export class FlightsComponent implements OnInit {
  public flightsmodel;
  public rows;
  public rowss;
  public row;
  public row1;


  constructor(
    private FlightsService:FlightsService,

  ) { 
    this.flightsmodel= new flightsmodel();
  }

  ngOnInit(): void {
    this.searchRoutes();
    this.plane();
  }


  submit(){
    console.log(this.flightsmodel)
    let params = {flights:this.flightsmodel};
    console.log(params)
    this.FlightsService.create(params).subscribe(result=>{
     this.searchRoutes();
    },error=>{
      swal.fire( 'Ha ocurrido un error','Los datos no son correctos','error');
  })   
  }

  plane(){
    let params;
     this.FlightsService.plane(params).subscribe(result=>{
       this.rowss=result;
       this.rows=this.rowss.search;
       console.log(this.rows);
     },error=>{})
   }

   searchRoutes(){
    let params;
    this.FlightsService.searchRoutes(params).subscribe(result=>{
      this.row1=result;
      this.row=this.row1.search;
      console.log(this.row);
    },error=>{})
   }


}
