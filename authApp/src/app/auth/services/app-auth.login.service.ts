import { Injectable } from '@angular/core';
import { AppAuthConstant } from "../interafaces/app-auth.constant";
import { HttpClient, HttpHeaders, HttpParams } from "@angular/common/http";
import { Observable } from "rxjs";
import { catchError } from "rxjs/operators";
import { of } from "rxjs/internal/observable/of";
import {AppAuthLoginInterface, AppAuthRegisterInterface} from "../interafaces/app-auth.interface";
import {InputIdleInterface} from "../../shared/directives/input-idle.interface";

@Injectable()

export class AppAuthLoginService {
  constructor(private http: HttpClient) {
  }

  login(credentials: AppAuthLoginInterface):Observable<any> {
    let headers: HttpHeaders = new HttpHeaders();
    let bodyData: HttpParams = new HttpParams();

    headers = headers
                .set('Content-Type','application/x-www-form-urlencoded')
                .set('Authorization', 'Basic ' + btoa(
                  `${AppAuthConstant.LOGIN.PROJECT_KEY}:${AppAuthConstant.LOGIN.PROJECT_AUTH_TYPE}`
                ));

    bodyData = bodyData
                .set('grant_type', AppAuthConstant.LOGIN.GRANT_TYPE)
                .set('username', credentials.username)
                .set('password', credentials.password);

    return this.http
      .post( AppAuthConstant.LOGIN.API_URL, bodyData, { headers })
      .pipe(catchError(error => {
          console.log(AppAuthConstant.SERVICE_STATUS_MESSAGES.ERROR, error);

          return of(error);
        })
      )
  }

  register(credentials: AppAuthRegisterInterface): Observable<any> {

    const apiUrl: string = AppAuthConstant.REGISTER.API_URL;

    const body: AppAuthRegisterInterface= {
      email: credentials.email,
      firstName: credentials.firstName,
      lastName: credentials.lastName,
      username: credentials.username,
      password: credentials.password
    };


    return this.http.post(apiUrl, body)
      .pipe(catchError(error => {
        console.log(AppAuthConstant.SERVICE_STATUS_MESSAGES.ERROR, error);

        return of(error);
      }))
  }

  checkCredentials(credentials): Observable<any> {
    let apiUrl: string = `${AppAuthConstant.REGISTER.CHECK_STATUS}/${credentials.type}-exists/`;
    let body = {
      params: {
        [credentials.type]: credentials.value
      }
    };

    return this.http.get(apiUrl, body)
      .pipe(catchError(error => {
        console.log(AppAuthConstant.SERVICE_STATUS_MESSAGES.ERROR, error);

        return of(error);
      }))
  }
}
