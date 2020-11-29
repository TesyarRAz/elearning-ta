import 'package:elearning/views/ui/auth/login.dart';
import 'package:elearning/views/ui/home.dart';
import 'package:elearning/views/ui/modul.dart';
import 'package:elearning/views/ui/detail_modul.dart';
import 'package:flutter/material.dart';

final routes = <String, WidgetBuilder>{
  "/": (_) => HomePage(),
  "/login": (_) => LoginPage(),
  '/modul': (_) => ModulPage(),
};

final routeGenerator = (RouteSettings settings) {
	final args = settings.arguments;

	switch (settings.name) {
		case "/":
			return slideRoute(HomePage());
		case "/login":
			return slideRoute(LoginPage());
		case "/modul":
			return slideRoute(ModulPage());
		case "/modul/detail":
			return slideRoute(DetailModulPage(modul: args));
	}
};

final slideRoute = (Widget page) => PageRouteBuilder(
	pageBuilder: (context, animation, secondaryAnimation) => page,
	transitionsBuilder: (context, animation, secondaryAnimation, child) => FadeTransition(
		opacity: animation,
		child: child
	)
);