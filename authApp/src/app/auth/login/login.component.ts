import { Component, EventEmitter, Input, OnDestroy, OnInit, Output} from '@angular/core';
import { Subject } from 'rxjs/internal/Subject';

import { AppAuthLoginService } from './../services/app-auth.login.service';
import { AppAuthLoginInterface } from '../interafaces/app-auth.interface';
import { AppAuthConstant } from '../interafaces/app-auth.constant';

import { takeUntil} from 'rxjs/operators';

@Component({
  selector: 'auth-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class AuthLoginComponent implements OnInit, OnDestroy {

  @Input() errorMessage: string;

  @Output() authStatus: EventEmitter<any> = new EventEmitter<any>();

  loginUserName: string;
  loginPassword: string;

  isLoading: boolean = false;

  private ngUnsubscribe: Subject<any> = new Subject();

  constructor(private appAuthLoghinService: AppAuthLoginService) { }

  ngOnInit() {
  }

  authSubmit() {
    if (!this.loginUserName || !this.loginPassword || this.isLoading) {
      return;
    }

    this.isLoading = true;

    let credentials: AppAuthLoginInterface = {
      username: this.loginUserName,
      password: this.loginPassword,
      grant_type: AppAuthConstant.LOGIN.GRANT_TYPE,
      project_key: AppAuthConstant.LOGIN.PROJECT_KEY
    };

    this.appAuthLoghinService.login(credentials)
      .pipe(takeUntil(this.ngUnsubscribe))
      .subscribe((res) => {
        console.log('results!', res);

        this.isLoading = false;
      })

  }

  ngOnDestroy() {
    this.ngUnsubscribe.next();
    this.ngUnsubscribe.complete();
  }
}
