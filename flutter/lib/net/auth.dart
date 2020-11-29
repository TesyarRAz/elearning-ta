import 'dart:convert';

import 'package:elearning/constant.dart';
import 'package:elearning/models/response.dart';
import 'package:elearning/models/user.dart';
import 'package:elearning/net/repository.dart';

class Auth {
  static Auth _instance;

  Auth._();

  static Auth get instance => _instance ??= Auth._();

  Future<Response<User>> login(String usernameEmail, String password) {
    return Repository.instance.client
        .post(
          API_HOST + "login",
          body: {
            'username_email': usernameEmail, 
            'password': password
          },
        )
        .then((response) => jsonDecode(response.body))
        .then(
            (map) => Response<User>.fromMap(map, (data) => User.fromMap(data)));
  }
}
