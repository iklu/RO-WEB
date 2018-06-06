import { Component, EventEmitter, Input, OnDestroy, OnInit, Output } from '@angular/core';
import { Subject } from "rxjs/internal/Subject";
import { takeUntil} from 'rxjs/operators';

import { AppAuthLoginService } from "./../services/app-auth.login.service";
import {
  AppAuhLoginBehaviourInterface,
  AppAuthLoginInterface,
  AppAuthRegisterInterface
} from "../interafaces/app-auth.interface";

@Component({
  selector: 'auth-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.scss']
})
export class AuthRegisterComponent implements OnInit, OnDestroy {

  @Input() errorMessage: string;

  @Output() authRegisterStatus: EventEmitter<any> = new EventEmitter<any>();

  registerUserName: string;
  registerEmail: string;
  registerPassword: string;
  registerFirstName: string;
  registerLastName: string;

  error: AppAuhLoginBehaviourInterface = {
    message: this.errorMessage || 'Invalid credentials',
    show: false
  };

  loading: AppAuhLoginBehaviourInterface = {
    show: false
  };


  private ngUnsubscribe: Subject<any> = new Subject();

  constructor(private appAuthLoghinService: AppAuthLoginService) { }

  ngOnInit() {
  }

  /**
   * Method to check if username exists
   */
  checkUserName() {
    if (!this.registerUserName) {
      return;
    }

    //call a service maybe bellow
  }

  registerSubmit() {

    if (!this.checkInputsReady()) {
      return;
    }

    this.loading.show = true;

    let credentials: AppAuthRegisterInterface = {
      username: this.registerUserName,
      password: this.registerPassword,
      email: this.registerEmail,
      firstName: this.registerFirstName,
      lastName: this.registerLastName
    };

    this.appAuthLoghinService.register(credentials)
      .pipe(takeUntil(this.ngUnsubscribe))
      .subscribe((res) => {
        if (res && res.error) {
          this.error.show = true;
        }

        // send over to parent component auth status whatever it may be
        this.authRegisterStatus.emit(res);

        // hide loading status
        this.loading.show = false;
      })
  }

  checkInputsReady() {
    return this.registerFirstName &&
           this.registerLastName &&
           this.registerPassword &&
           this.registerUserName &&
           this.registerEmail;
  }

  ngOnDestroy() {
    this.ngUnsubscribe.next();
    this.ngUnsubscribe.complete();
  }
}
