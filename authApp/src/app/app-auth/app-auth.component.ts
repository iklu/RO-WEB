import {Component, EventEmitter, OnDestroy, OnInit, Output} from '@angular/core';
import {Subject} from "rxjs/internal/Subject";
import {AppAuthLoginService} from "./services/app-auth.login.service";
import {takeUntil} from "rxjs/operators";

@Component({
  selector: 'app-auth',
  templateUrl: './app-auth.component.html',
  styleUrls: ['./app-auth.component.scss']
})
export class AppAuthComponent implements OnInit, OnDestroy {

  @Output() authStatus: EventEmitter<any> = new EventEmitter<any>();

  private ngUnsubscribe: Subject<any> = new Subject();

  constructor(private appAuthLoghinService: AppAuthLoginService) { }

  ngOnInit() {
  }

  authSubmit() {
    console.log('Buya Ive done something');

    let credentials = {
      username: 'John',
      password: 'Doe'
    }

    this.appAuthLoghinService.login(credentials)
      .pipe(takeUntil(this.ngUnsubscribe))
      .subscribe((res) => {
        console.log('HAHA', res);
      })

  }

  ngOnDestroy() {
    this.ngUnsubscribe.next();
    this.ngUnsubscribe.complete();
  }
}
