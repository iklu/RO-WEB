import {Component, EventEmitter, Input, OnDestroy, OnInit, Output} from '@angular/core';
import {Subject} from "rxjs/internal/Subject";
import {AppAuthLoginService} from "./../services/app-auth.login.service";
import {takeUntil} from "rxjs/operators";

@Component({
  selector: 'auth-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.scss']
})
export class AuthRegisterComponent implements OnInit, OnDestroy {

  @Output() registerStatus: EventEmitter<any> = new EventEmitter<any>();

  registerUserName: string;
  registerFirstName: string;
  registerLastName: string;
  registerPassword: string;

  userNameUnique: boolean;
  registerFormIsValid: boolean;


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

    this.userNameUnique = true;

    //call a service maybe bellow
  }

  registerSubmit() {
    if (this.registerUserName &&
        this.registerFirstName &&
        this.registerLastName &&
        this.registerPassword ) {
    }


    //
    // this.appAuthLoghinService.register()
    //   .pipe(takeUntil(this.ngUnsubscribe))
    //   .subscribe((res) => {
    //     console.log('HAHA', res);
    //   })

  }

  ngOnDestroy() {
    this.ngUnsubscribe.next();
    this.ngUnsubscribe.complete();
  }
}
