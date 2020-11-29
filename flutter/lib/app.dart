import 'package:elearning/routes.dart';
import 'package:elearning/theme.dart';
import 'package:flutter/material.dart';

class ElearningApplication extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      theme: appTheme,
      onGenerateRoute: routeGenerator
    );
  }
}
