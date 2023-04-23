const express = require("express");
const socketio = require("socket.io");
const app = express();

app.set("view engine", "ejs");
app.use(express.static("public"));

// Initialize socket for the server
const server = app.listen(process.env.PORT || 3000, () => {
  console.log("เซิฟเวอร์ทำงานปกติค้าบ");
});

const io = socketio(server);

// store user count
let userCount = 0;

io.on("connection", socket => {
  console.log("มีการเชื่อมต่อเข้ามาค้าบ");

  // increment user count when new user connects
  userCount++;

  // send user count to all connected clients
  io.sockets.emit("user_count", userCount);

  socket.on("change_username", data => {
    socket.username = data.username;
  });

  // handle the new message event
  socket.on("new_message", data => {
    console.log("มีคนส่งความ");
    io.sockets.emit("receive_message", {
      message: data.message,
      username: socket.username
    });
  });

  socket.on("typing", data => {
    socket.broadcast.emit("typing", { username: socket.username });
  });

  socket.on("disconnect", () => {
    console.log("มีการยกเลิกการเชื่อมต่อค้าบ");

    // decrement user count when user disconnects
    userCount--;

    // send user count to all connected clients
    io.sockets.emit("user_count", userCount);
  });
});

app.get("/", (req, res) => {
  res.render("index");
});
// จำนวน
app.get("/user-count", (req, res) => {
  res.send(userCount.toString());
});
