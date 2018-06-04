import { Injectable } from '@angular/core';
import { AppAuthConstant } from "../interafaces/app-auth.constant";
import { HttpClient, HttpHeaders, HttpParams } from "@angular/common/http";
import { Observable } from "rxjs";
import { catchError } from "rxjs/operators";
import { of } from "rxjs/internal/observable/of";
import { AppAuthLoginInterface } from "../interafaces/app-auth.interface";

@Injectable()

export class AppAuthLoginService {
  constructor(private http: HttpClient) {
  }

  login(credentials: AppAuthLoginInterface):Observable<any> {
    let headers: HttpHeaders = new HttpHeaders();
    let bodyData: HttpParams = new HttpParams();

    headers = headers
                .set('Content-Type','application/x-www-form-urlencoded')
                .set('Authorization', 'Basic ' + btoa(`${credentials.project_key}:${credentials.password}`));

    bodyData = bodyData
                .set('grant_type', credentials.grant_type)
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


  register(): Observable<any> {
    let apiUrl = 'https://morning-sierra-30833.herokuapp.com/api/user/registration';

    return this.http.post(apiUrl, {
      "email": "suvaialaremus@gmail.com",
      "firstName": "remus",
      "lastName": "george",
      "password": "123456",
      "username": "georgel"
    })
      .pipe(catchError(error => {
        console.warn('Shit happens:', error);
        return of(error);
      }))
  }
}
