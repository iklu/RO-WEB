import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppComponent } from './app.component';
import { AuthLoginComponent } from "./auth/login/login.component";
import { FormsModule } from "@angular/forms";
import { AppAuthLoginService } from "./auth/services/app-auth.login.service";
import { HttpClientModule} from "@angular/common/http";
import { AuthRegisterComponent } from "./auth/register/register.component";
import { InputIdleDirective } from "./shared/directives/input-idle.directive";
import {InputValidationDirective} from "./shared/directives/input-validation.directive";

@NgModule({
  declarations: [
    AppComponent,
    AuthLoginComponent,
    AuthRegisterComponent,
    InputIdleDirective,
    InputValidationDirective
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
