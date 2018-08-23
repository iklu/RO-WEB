export class AppAuthConstant {
  static readonly BASE_URL: '';

  //login stuff
  static readonly LOGIN = {
    API_URL: 'https://morning-sierra-30833.herokuapp.com/oauth/token',
    GRANT_TYPE: 'password',
    PROJECT_KEY: 'projectstartup',
    PROJECT_AUTH_TYPE: 'parola'
  };

  //register stuff
  static readonly REGISTER = {
    API_URL: 'https://morning-sierra-30833.herokuapp.com/api/user/registration',
    CHECK_STATUS: 'https://morning-sierra-30833.herokuapp.com/api/user',
    MIN_CHARS: {
      USERNAME: 4
    }
  };

  static readonly LOGIN_URL: string = 'https://morning-sierra-30833.herokuapp.com/oauth/token';
  static readonly REGISTER_URL: '';
  static readonly RESET_PASS: '';
  static readonly SERVICE_STATUS_MESSAGES = {
    ERROR: 'Error in service: ',
    SUCCESS: 'Service success: '
  }

}


