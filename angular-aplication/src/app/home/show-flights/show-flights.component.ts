import { Component, OnInit } from '@angular/core';
import { flightsmodel } from '../../models/flights.model';
import { FlightsService } from '../../services/flights/flights.service';
import { payflightsmodel } from '../../models/payflights.model';
import swal from'sweetalert2';

@Component({
  selector: 'app-show-flights',
  templateUrl: './show-flights.component.html',
  styleUrls: ['./show-flights.component.css']
})
export class ShowFlightsComponent implements OnInit {
  public flightsmodel;
  public posts : any [];
  public row1;
  public row;
  public rowss;
  public rows;
  public payflightsmodel;

  constructor(
    private FlightsService:FlightsService,

  ) { 
    this.flightsmodel= new flightsmodel();
    this.payflightsmodel= new payflightsmodel();
  }
  ngOnInit(): void {
  this.searchRoutes();
  }
  searchRoutes(){
    let params="prueba";
    this.FlightsService.searchRoutes(params).subscribe(res=>{
      this.row1=res;
      this.row=this.row1.search;
      console.log(this.row1);
    },error=>{})
   }
   PayTicket(index: number, post: any ){
    this.flightsmodel=post;
   }
   ticket(){

   }

}
