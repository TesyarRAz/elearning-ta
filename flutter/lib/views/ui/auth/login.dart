import 'package:elearning/net/auth.dart';
import 'package:elearning/theme.dart';
import 'package:flutter/material.dart';

class LoginPage extends StatefulWidget {
  @override
  State<StatefulWidget> createState() => _LoginPageState();
}

class _LoginPageState extends State<LoginPage> {
  TextEditingController _username;
  TextEditingController _password;
  bool _showPassword = false;

  @override
  void initState() {
    super.initState();

    _username = TextEditingController();
    _password = TextEditingController();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
        body: Padding(
      padding: const EdgeInsets.all(10),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Text(
            "Username",
            style: appTheme.textTheme.headline4,
          ),
          TextField(
            controller: _username,
            decoration: InputDecoration(
              border: OutlineInputBorder(),
            ),
          ),
          SizedBox(height: 10),
          Text(
            "Password",
            style: appTheme.textTheme.headline4,
          ),
          TextField(
            obscureText: !_showPassword,
            controller: _password,
            decoration: InputDecoration(
              border: OutlineInputBorder(),
              suffixIcon: IconButton(
                icon: Icon(
                    !_showPassword ? Icons.visibility : Icons.visibility_off),
                onPressed: () {
                  setState(() {
                    _showPassword = !_showPassword;
                  });
                },
              ),
            ),
          ),
          SizedBox(height: 10),
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              FlatButton(
                onPressed: () {},
                child: Text("Lupa Kata Sandi"),
                padding: const EdgeInsets.symmetric(horizontal: 10),
              ),
              RaisedButton(
                onPressed: () {
                  _fetchLogin();
                },
                child: Text("Login"),
              ),
            ],
          )
        ],
      ),
    ));
  }

  void _fetchLogin() {
    Navigator.of(context).pushReplacementNamed("/");
  }
}
