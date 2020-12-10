import { BrowserModule } from '@angular/platform-browser';
import { NgModule} from '@angular/core';
import { FormsModule } from '@angular/forms';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { LoginComponent } from './login/login.component';
import { HttpClientModule } from '@angular/common/http';
import { HomeComponent } from './home/home.component';
import { NavbarComponent } from './home/navbar/navbar.component';
import { RegisterUserComponent } from './home/register-user/register-user.component';
import { RegisterUserService } from './services/register-users/register-user.service';
import { FlightsComponent } from './home/flights/flights.component';
import { FlightsService } from './services/flights/flights.service';
import { ShowFlightsComponent } from './home/show-flights/show-flights.component';
import { PqrsComponent } from './home/pqrs/pqrs.component';
import { PqrsService } from './services/pqrs/pqrs.service';
import { MainComponent } from './home/main/main.component';

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    HomeComponent,
    NavbarComponent,
    RegisterUserComponent,
    FlightsComponent,
    ShowFlightsComponent,
    PqrsComponent,
    MainComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    HttpClientModule
  ],
  providers: [FlightsService, RegisterUserService, PqrsService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
