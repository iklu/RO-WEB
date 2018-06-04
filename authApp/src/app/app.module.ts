import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppComponent } from './app.component';
import { AuthLoginComponent } from "./auth/login/login.component";
import { FormsModule } from "@angular/forms";
import { AppAuthLoginService } from "./auth/services/app-auth.login.service";
import { HttpClientModule} from "@angular/common/http";
import { AuthRegisterComponent } from "./auth/register/register.component";

@NgModule({
  declarations: [
    AppComponent,
    AuthLoginComponent,
    AuthRegisterComponent
  ],
  imports: [
    BrowserModule,
    HttpClientModule,
    FormsModule
  ],
  providers: [
    AppAuthLoginService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
