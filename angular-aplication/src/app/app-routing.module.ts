import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { LoginComponent } from './login/login.component';
import { AppComponent } from './app.component';
import { HomeComponent } from './home/home.component';
import { NavbarComponent } from './home/navbar/navbar.component';
import { RegisterUserComponent } from './home/register-user/register-user.component';
import { FlightsComponent } from './home/flights/flights.component';
import { ShowFlightsComponent } from './home/show-flights/show-flights.component';
import { PqrsComponent } from './home/pqrs/pqrs.component';

  


const routes: Routes = [
  {
    path: "",
    component: AppComponent,
    children: [
          { 
          path: "", 
          component: LoginComponent 
        },
        { 
          path: "login", 
          component: LoginComponent 
        },
        { 
          path: "home", 
          component: HomeComponent,
          children: [
         
        { 
          path: "navbar", 
          component: NavbarComponent 
        },
        { 
          path: "", 
          component: RegisterUserComponent 
        },
        { 
          path: "register-users", 
          component: RegisterUserComponent 
        },
        { 
          path: "flights", 
          component: FlightsComponent 
        },
        { 
          path: "show-flights", 
          component: ShowFlightsComponent 
        },
        { 
          path: "pqrs", 
          component: PqrsComponent 
        },
      ]
       },   
        
            
           
        
       
]
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
