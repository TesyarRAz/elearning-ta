import 'package:http/http.dart' show Client;

class Repository {
  static Repository _instance;

  static Repository get instance => _instance ??= Repository._();

  Client _client;
  Repository._();

  Client get client => _client ??= Client();
}
