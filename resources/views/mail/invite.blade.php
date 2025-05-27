<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Task List Invitation</title>
    </head>

    <body style="margin:0; padding:0; background-color:#f4f4f7;">
        <table style="background-color:#f4f4f7; padding: 40px 0;" width="100%" cellpadding="0"
            cellspacing="0">
            <tr>
                <td align="center">
                    <table
                        style="max-width: 600px; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);"
                        width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="padding: 32px 32px 16px 32px; text-align: center;">
                                <h2
                                    style="margin: 0 0 16px 0; color: #2563eb; font-family: Arial, sans-serif;">
                                    You're Invited!</h2>
                                <p
                                    style="margin: 0 0 24px 0; color: #333; font-size: 16px; font-family: Arial, sans-serif;">
                                    <strong>{{ $user->name }}</strong> has invited you to
                                    collaborate on the shared task list
                                    <strong>{{ $taskList->name }}</strong>.
                                </p>
                                <a href="{{ $link }}"
                                    style="display: inline-block; padding: 12px 28px; background-color: #2563eb; color: #fff; border-radius: 4px; text-decoration: none; font-size: 16px; font-family: Arial, sans-serif; font-weight: bold; margin-bottom: 24px;">
                                    Accept Invitation
                                </a>
                                <p
                                    style="margin: 24px 0 0 0; color: #888; font-size: 13px; font-family: Arial, sans-serif;">
                                    If you did not expect this invitation, you can safely ignore
                                    this email.
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 16px 32px 32px 32px; text-align: center;">
                                <span
                                    style="color: #b0b0b0; font-size: 12px; font-family: Arial, sans-serif;">
                                    &copy; {{ date('Y') }} To Do App | David Brablc
                                </span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>

</html>
