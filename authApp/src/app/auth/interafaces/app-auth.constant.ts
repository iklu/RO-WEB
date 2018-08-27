export class AppAuthConstant {

  static readonly BASE_URL: string = 'http://86.124.155.72:9000';

  //login stuff
  static readonly LOGIN = {
    API_URL: `${AppAuthConstant.BASE_URL}/oauth/token`,
    GRANT_TYPE: 'password',
    PROJECT_KEY: 'projectstartup',
    PROJECT_AUTH_TYPE: 'parola'
  };

  //register stuff
  static readonly REGISTER = {
    API_URL: `${AppAuthConstant.BASE_URL}/api/user/registration`,
    CHECK_STATUS: `${AppAuthConstant.BASE_URL}/api/user`,
    MIN_CHARS: {
      USERNAME: 4
    }
  };

  static readonly SERVICE_STATUS_MESSAGES = {
    ERROR: 'Error in service: ',
    SUCCESS: 'Service success: '
  }

}


