import { Component, EventEmitter, Input, OnDestroy, OnInit, Output } from '@angular/core';
import { Subject } from 'rxjs/internal/Subject';
import { takeUntil} from 'rxjs/operators';

import { AppAuthLoginService } from './../services/app-auth.login.service';
import {
  AppAuthLoginInterface, AppAuhLoginBehaviourInterface,
  AppAuthInterfaceLoginSuccessEvent
} from '../interafaces/app-auth.interface';


@Component({
  selector: 'auth-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class AuthLoginComponent implements OnInit, OnDestroy {

  @Input() errorMessage: string;
  @Input() instanceName: string;

  @Output() authLoginStatus: EventEmitter<any> = new EventEmitter<any>();

  loginUserName: string;
  loginPassword: string;

  error: AppAuhLoginBehaviourInterface = {
    message: this.errorMessage || 'Invalid credentials',
    show: false
  };

  loading: AppAuhLoginBehaviourInterface = {
    show: false
  };

  private ngUnsubscribe: Subject<any> = new Subject();

  constructor(private appAuthLoghinService: AppAuthLoginService) {
    if (!this.instanceName) {
      this.instanceName = Math.floor((1 + Math.random()) * 0x10000)
                              .toString(16)
                              .substring(1);
    }
  }

  ngOnInit() {
  }

  authSubmit() {
    if (!this.loginUserName || !this.loginPassword || this.loading.show) {
      return;
    }

    this.error.show = false;
    this.loading.show = true;

    let credentials: AppAuthLoginInterface = {
      username: this.loginUserName,
      password: this.loginPassword
    };

    this.appAuthLoghinService.login(credentials)
      .pipe(takeUntil(this.ngUnsubscribe))
      .subscribe((res: AppAuthInterfaceLoginSuccessEvent) => {
        // send over to parent component auth status whatever it may be
        res.userName = this.loginUserName;

        this.authLoginStatus.emit(res);

        // hide loading status
        this.loading.show = false;
      }, (error) => {
        this.error.show = true;

        this.errorMessage = error;
      })

  }

  ngOnDestroy() {
    this.ngUnsubscribe.next();
    this.ngUnsubscribe.complete();
  }
}

