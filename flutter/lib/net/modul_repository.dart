import 'dart:convert';

import 'package:elearning/models/modul.dart';

class ModulRepository {
  static ModulRepository _instance;

  static ModulRepository get instance => _instance ??= ModulRepository._();

  ModulRepository._();

  Future<Response<List<Modul>>> fetchModul(int page) {
    return Future.delayed(Duration(seconds: 3), () {
      return List.generate(10, (index) => 
        Modul(name: 'Modul #${(page * 10) + index}')
      );
    });
  }
}