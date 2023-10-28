const { app, BrowserWindow } = require('electron')

function createWindow() {
  const win = new BrowserWindow({
    width: 800,
    height: 600,
    webPreferences: {
      nodeIntegration: true,
    },
  })

  win.loadURL('http://localhost:8000') // Replace with your Laravel server URL

  // Open the DevTools in development mode
  if (process.env.NODE_ENV === 'development') {
    win.webContents.openDevTools()
  }
}

app.whenReady().then(createWindow)
