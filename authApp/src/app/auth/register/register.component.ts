import { Component, EventEmitter, Input, OnDestroy, OnInit, Output } from '@angular/core';
import { Subject } from 'rxjs/internal/Subject';
import { takeUntil } from 'rxjs/operators';

import { AppAuthLoginService } from "./../services/app-auth.login.service";
import {
  AppAuhLoginBehaviourInterface,
  AppAuhRegisterBehaviourInterface,
  AppAuthRegisterInterface
} from "../interafaces/app-auth.interface";
import {AppAuthConstant} from "../interafaces/app-auth.constant";
import {InputValidationEvent} from "./register.defaults";

@Component({
  selector: 'auth-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.scss']
})
export class AuthRegisterComponent implements OnInit, OnDestroy {

  @Input() errorMessage: string;
  @Input() errorMessageExistingUsername: string;

  @Output() authRegisterStatus: EventEmitter<any> = new EventEmitter<any>();

  registerUserName: string;
  registerEmail: string;
  registerPassword: string;
  checkRegisterPassword: string;
  registerFirstName: string;
  registerLastName: string;
  registerUserNameMinChars: number = AppAuthConstant.REGISTER.MIN_CHARS.USERNAME;

  errorMinChars: boolean;
  errorMaxChars: boolean;
  errorNotAllowed: boolean;
  errorUsername: boolean;
  errorLoading: boolean = false;
  userNameSucces: boolean = false;

  error: AppAuhRegisterBehaviourInterface = {
    message: this.errorMessage || 'Invalid credentials',
    messageExistingUsername: this.errorMessageExistingUsername || `${this.registerUserName} already exists!`,
    show: false
  };

  checkUsernameInputStatus: any = {};

  inputStatus: InputValidationEvent;

  loading: AppAuhLoginBehaviourInterface = {
    show: false
  };


  private ngUnsubscribe: Subject<any> = new Subject();

  constructor(private appAuthLoginService: AppAuthLoginService) { }

  ngOnInit() {
  }

  registerSubmit() {

    if (!this.checkInputsReady()) {
      return;
    }

    this.loading.show = true;

    let credentials: AppAuthRegisterInterface = {
      username: this.registerUserName,
      password: this.registerPassword,
      matchingPassword: this.checkRegisterPassword,
      email: this.registerEmail,
      firstName: this.registerFirstName,
      lastName: this.registerLastName
    };

    this.appAuthLoginService.register(credentials)
      .pipe(takeUntil(this.ngUnsubscribe))
      .subscribe((res) => {
        if (res && res.error) {
          this.error.show = true;
        }

        // send over to parent component auth status whatever it may be
        this.authRegisterStatus.emit(res);

        // hide loading status
        this.loading.show = false;
      }, error => {
        console.error(`${AppAuthConstant.SERVICE_STATUS_MESSAGES.ERROR}:${error}`);
      })
  }

  checkInputsReady() {
    return this.inputStatus &&
           this.inputStatus.status === 'idle'  &&
           this.registerFirstName &&
           this.registerLastName &&
           this.registerPassword &&
           this.checkRegisterPassword &&
           this.registerUserName &&
           this.registerEmail;
  }

  /**
   * Check for existing userName
   * Behaviour: onBlur, after a timeout (user intent is to leave the input field)
   * Check with service for this username
   */
  checkStatus(event) {
    this.inputStatus = event;

    console.log('a', event);
    this.errorMinChars = false;
    this.errorMaxChars = false;
    this.errorNotAllowed = false;
    this.errorUsername = false;
    this.userNameSucces = false;
    this.errorLoading = false;
    this.userNameSucces = false;

    if (!this.inputStatus) {
      return;
    }

    this.errorLoading = true;

    if (this.inputStatus.status !== 'active' &&
        this.inputStatus.status !== 'indeterminate') {
      this.errorLoading = false;

      if (this.inputStatus.errorMinChars) {
        this.errorMinChars = true;
      } else if (this.inputStatus.errorMaxChars) {
        this.errorMaxChars = true;
      } else if (this.inputStatus.errorNotAllowed) {
        this.errorNotAllowed = true;
      }
    }

    if (!this.inputStatus.inputType ||
        this.inputStatus.hasError ||
        this.inputStatus.status !== 'idle') {
      return;
    }

    this.errorLoading = true;

    this.appAuthLoginService.checkCredentials({
      value: this.inputStatus.value,
      type: this.inputStatus.inputType
    })
      .pipe(takeUntil(this.ngUnsubscribe))
      .subscribe((res) => {
        this.errorLoading = false;
        this.errorMinChars = false;

        if (!res || res.error) {
          this.errorUsername = true;

          return;
        }

        this.userNameSucces = true;
      })
  }

  ngOnDestroy() {
    this.ngUnsubscribe.next();
    this.ngUnsubscribe.complete();
  }
}
