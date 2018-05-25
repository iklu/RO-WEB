import { Injectable } from '@angular/core';
import { AppAuthConstant } from "../app-auth.constant";
import { HttpClient } from "@angular/common/http";
import { Observable } from "rxjs";

import {catchError} from "rxjs/operators";
import { of } from "rxjs/internal/observable/of";

@Injectable()

export class AppAuthLoginService {
  constructor(private http: HttpClient) {
  }

  login(credentials: any):Observable<any> {
    let endPoint = `https://morning-sierra-30833.herokuapp.com/oatuh/token`;

    return this.http.post(endPoint, {
      params: {
        clientId: 'projectstartup',
        clientSecret: credentials.password || null,
        password: credentials.password || null,
        username: credentials.username || null
      },
      headers: {
        'Authorization': 'Basic',
        'Content-type': 'application/x-www-form-urlencoded; charset=utf-8'
      }
    })
      .pipe(catchError(error => {
          console.warn('Shit happens:', error);
          return of(error);
        }))
  }
}
