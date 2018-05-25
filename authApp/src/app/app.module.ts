import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppComponent } from './app.component';
import { AppAuthComponent } from './app-auth/app-auth.component';
import { FormsModule } from "@angular/forms";
import { AppAuthLoginService } from "./app-auth/services/app-auth.login.service";
import { HttpClientModule} from "@angular/common/http";

@NgModule({
  declarations: [
    AppComponent,
    AppAuthComponent
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
