import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css']
})
export class NavbarComponent implements OnInit {
  public user_name;
  public password;
    constructor(
    ) { }
  
    ngOnInit() {
      this.getUserName();
    }
  
    sesionDestroy() {
      localStorage.clear();
    }
  

  
    getUserName() {
      let session = localStorage.getItem("token");
      console.log(session);
    }
  
}
