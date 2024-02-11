tolong teliti program vb ini Dim ADOConn As New ADODB.Connection
Private Sub Dial()
    Dim dummy
    Dim myDebug As Boolean

    Dim i As Integer
    Dim wt As String
    Dim wt1 As String
    Dim wt2 As String
    Dim wt3 As String
    Dim wt4 As String
    Dim xx As Integer
    Dim nSecond As Single
    Dim t0 As Single
    Dim t1 As Single
    Dim val As Long

    myDebug = True

    If myDebug = True Then MsgBox "TEST DEBUG"

    MSComm1.CommPort = 1
    'MSComm1.Settings = "9600,E,8,1"
    MSComm1.Settings = "2400,E,7,1"
    MSComm1.PortOpen = True
    On Error Resume Next
    If Err Then
       MsgBox "COM2: Error Initializing Comm Port"
       Exit Sub
    End If

    If myDebug = True Then MsgBox "Config Sukses"

    MSComm1.InBufferCount = 0
'==============1 Send Request
   nSecond = 2
   val = 0
   t0 = Timer
   MSComm1.Output = Chr(5)
   Do While Timer - t0 < nSecond And val = 0
      dummy = DoEvents()
      val = MSComm1.InBufferCount
      If Timer < t0 Then
         t0 = t0 - CLng(24) * CLng(60) * CLng(60)
      End If
   Loop

   If myDebug = True Then MsgBox "Send req 1 OK"

 '==============2  Receive Acknoledgement
   wt1 = MSComm1.Input
   If myDebug = True Then MsgBox "Receipt Data 1 " + wt1
   'If wt1 <> Chr(6) Then
      Write2File (wt1)
      MSComm1.PortOpen = False
      End
   'End If


 '==============3  Request Message
   nSecond = 2
   val = 0
   t0 = Timer
   MSComm1.Output = Chr(2) + "01#TG#" + Chr(3) + Chr(17)
   Do While Timer - t0 < nSecond And val = 0
    val = MSComm1.InBufferCount
    If Timer < t0 Then
      t0 = t0 - CLng(24) * CLng(60) * CLng(60)
    End If
   Loop
   '==========4 Receive Acknoledgement
   wt2 = MSComm1.Input
   If wt2 <> Chr(6) Then
     Write2File ("1234567ERROR2")
     MSComm1.PortOpen = False
   End
   End If

   If myDebug = True Then MsgBox "Receipt Data 2 " + wt2


 '==========5 Receive Data Request Sending
  nSecond = 5
  val = 0
  t0 = Timer
  dummy = DoEvents()
  Do While Timer - t0 < nSecond And val = 0
     val = MSComm1.InBufferCount
     If Timer < t0 Then
         t0 = t0 - CLng(24) * CLng(60) * CLng(60)
      End If
   Loop
   wt3 = MSComm1.Input
   If wt3 <> Chr(5) Then
      Write2File ("1234567ERROR3")
      MSComm1.PortOpen = False
      End
   End If

   If myDebug = True Then MsgBox "Receipt Data 3 " + wt3

 '==========6 Send Acknoledgement
  val = 0
  t0 = Timer
  nSecond = 2
  MSComm1.Output = Chr(6)
  Do While Timer - t0 < nSecond And val = 0
     val = MSComm1.InBufferCount
     If Timer < t0 Then
         t0 = t0 - CLng(24) * CLng(60) * CLng(60)
      End If
   Loop
   If val = 0 Then
      Write2File ("1234567ERROR4")
      MSComm1.PortOpen = False
      End
   End If

 '==========6 Receive Data
  val = 0
  t0 = Timer
  nSecond = 0.5
  Do While Timer - t0 < nSecond
     'val = MSComm1.InBufferCount
     If Timer < t0 Then
         t0 = t0 - CLng(24) * CLng(60) * CLng(60)
      End If
   Loop
   wt4 = MSComm1.Input

   If myDebug = True Then MsgBox "Receipt Data 4 " + wt4

 '==========6 Send Acknoledgement

  MSComm1.Output = Chr(6)

   Write2File (wt4)
   MSComm1.PortOpen = False
   End
End Sub
Private Sub Form_Load()
 Dim buffer$
 Dim Instring As String
 Dial
End Sub
Sub Write2File(wght$)
    Const ForReading = 1, ForWriting = 2, ForAppending = 3
    Dim fs, f
    Dim newText As String

    Dim a As Boolean
    Dim b As Boolean
    Dim i As Integer

    Dim st As String
    Set fs = CreateObject("Scripting.FileSystemObject")
    'Set f = fs.OpenTextFile("c:\weighment\Schenck.txt", ForWriting, True, TristateFalse)
    Set f = fs.OpenTextFile("c:\SAP\weight.txt", ForWriting, True, TristateFalse)

    a = True
    newText = ""
    i = 1
    Do While a = True
        If Mid(wght$, i, 1) = "+" Then
            b = True
            Do While b = True
                i = i + 1
                If Mid(wght$, i, 1) = "k" Then
                    b = False
                Else
                    newText = newText + Mid(wght$, i, 1)
                End If
            Loop
        End If
        If Mid(wght$, i, 1) = "k" Then
            a = False
        End If
        i = i + 1
    Loop


    'f.Write Trim(Mid(wght$, 11, 7))
    'f.Write Trim(wght$)
    MsgBox newText
    f.Write CLng(newText)

    'f.Write wght$
    MsgBox "Write to file done"
    f.Close

    'ADOConn.Open "DSN=ISPMAIL;UID=PRODUCTION;PWD=PRODUCTION"
    'ADOConn.Execute "insert into coil_wt_test(NU_WEIGHT,VC_STATUS) values ( '" + Mid(wght$, 8, 7) + "','P')", 1, adCmdText
    'ADOConn.Close
End Sub

