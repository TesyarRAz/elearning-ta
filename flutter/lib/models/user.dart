class User {
  String email;
  String username;
  String password;

  User({this.username, this.password, this.email});

  User.fromMap(Map<String, dynamic> map)
      : this(
          username: map['username'],
          password: map['password'],
          email: map['email'],
        );
}
